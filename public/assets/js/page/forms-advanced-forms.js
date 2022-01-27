"use strict";
document.addEventListener('DOMContentLoaded', () => {
  

var cleaveC = new Cleave('.currency', {
  numeral: true,
  numeralThousandsGroupStyle: 'thousand'
});
var cleave = new Cleave('.year', {
  date: true,
  datePattern: ['Y']
});
});  