@extends('layouts.main_user')

@section('content')

<section class="section">
  <div class="section-header">
    <h1>Liste des demandes</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="#">Forms</a></div>
      <div class="breadcrumb-item">Form Validation</div>
    </div>
  </div>



  <div class="section-body">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Résultats</h4>
              <div class="card-header-action">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped" id="sortable-table">
                  <thead>
                    <tr>
                      <th class="text-center">
                        <i class="fas fa-th"></i>
                      </th>
                      <th>Code</th>
                      <th>Date d'envoi</th>
                      <th>Remarques</th>
                      <th>état</th>
                      <th>Rapport</th>
                      <th>lettre d'acceptation</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($demandes as $demande)
                    <tr>
                      <td>
                        <div class="sort-handler">
                          <i class="fas fa-th"></i>
                        </div>
                      </td>
                      <td>{{$demande->code}}</td>
                      <td class="align-middle">
                        {{$demande->date_envoie}}
                      </td>
                      <td> {{$demande->remarques}}</td>
                      <td>
                        @if ($demande->etat === "PENDING")
                        <div class="badge badge-danger">{{$demande->etat}}</div>

                        @else
                        <div class="badge badge-success">{{$demande->etat}}</div>

                        @endif

                      </td>
                      <td>
                        <button class="btn btn-primary" id="modal-5{{$demande->id}}">
                          @if (!is_null($demande->manifestation->rapport))
                          éditer
                          @else
                          upload
                          @endif
                        </button>
                        @if (!is_null($demande->manifestation->rapport))
                        <a href="{{route('manifestation.read.rapport',['url'=>Str::replace('/','-',$demande->manifestation->rapport->url)])}}" class="btn btn-primary"> voir </a>
                        @endif

                      </td>
                      <td>
                        @if (!is_null($demande->manifestation->lettreAcceptation) )
                        <a href="{{route('manifestation.read.rapport',['url'=>Str::replace('/','-',$demande->manifestation->lettreAcceptation->url)])}}" class="btn btn-primary">voir</a>
                        @else
                        indisponible pour le moment
                        @endif
                      </td>
                      <td><a href="{{route('request.pdf',['id'=>$demande->id])}}" class="btn btn-secondary">Detail</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <meta name="_token" content="{{ csrf_token() }}">
</section>

@endsection
@section('scripts')
<script>
  demandes = @json($demandes);
  for (var i = 0; i < demandes.length; i < i++) {

    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("enctype", "multipart/form-data");
    form.classList.add('modal-part')

    var hideInput = document.createElement("input");
    hideInput.setAttribute("name", "demande");
    hideInput.value = demandes[i].id
    hideInput.style.visibility = "hidden";


    var div1 = document.createElement("div");
    div1.classList.add('form-group')

    var div2 = document.createElement("div");
    div2.classList.add('custom-file')

    var input = document.createElement("input");
    input.setAttribute("type", "file");
    input.setAttribute("id", "customFile");
    input.setAttribute("name", "rapport");
    input.setAttribute("required", true);
    input.classList.add('custom-file-input')

    var label = document.createElement("label");
    label.setAttribute("type", "file");
    label.setAttribute("id", "customFile");
    label.setAttribute("for", "customFile");
    label.classList.add('custom-file-label');
    label.innerHTML = 'Choose files'

    form.appendChild(div1);
    form.appendChild(hideInput);
    div1.appendChild(div2);
    div2.appendChild(input);
    div2.appendChild(label);



    $("#modal-5" + demandes[i].id).fireModal({
      title: 'Upload Rapport',
      body: $(form),
      footerClass: 'bg-whitesmoke',
      autoFocus: false,
      onFormSubmit: function(modal, e, form) {
        // Form Data

        let repport = e.target[0].files[0];
        let demande = e.target[1].value;
        var form_data = new FormData();
        form_data.append('rapport', repport);
        form_data.append('demande', demande);
        url = "{{route('manifestation.upload.rapport')}}"
        $.ajax({
          url: url,
          dataType: 'text', // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'POST',
          headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
          },
          success: function(response) {
            response = JSON.parse(response);
            form.stopProgress();
            if (response.code === 200) {
              modal.find('.modal-body').prepend('<div class="alert alert-info">' + response.message + '</div>')

            } else {
              modal.find('.modal-body').prepend('<div class="alert alert-danger">' + response.message + '</div>')

            }
          },
          error: function(error) {
            console.log("error", error);
            form.stopProgress();
            modal.find('.modal-body').prepend('<div class="alert alert-danger">Please try again!</div>')
          }
        });
        e.preventDefault();
      },
      shown: function(modal, form) {
        console.log(form)
      },
      buttons: [{
        text: 'Upload',
        submit: true,
        class: 'btn btn-primary btn-shadow',
        handler: function(modal) {}
      }]
    });

  }
</script>
@endsection