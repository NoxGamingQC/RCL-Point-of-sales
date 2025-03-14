import axios from 'axios';
import $ from 'jquery';
import 'jquery-ui';
import './bootstrap-datepicker.js';

window.$ = window.jQuery = $;

import 'bootstrap-sass';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */