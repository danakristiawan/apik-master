import DataTable from 'datatables.net-bs5';

import jQuery from 'jquery';
window.$ = jQuery;

import './bootstrap';

import toastr from 'toastr';
window.toastr = toastr;
window.toastr.options = {
  "progressBar": true,
  "showDuration": "100",
};

import Chart from 'chart.js/auto';
window.Chart = Chart;
