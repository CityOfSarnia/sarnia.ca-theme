// Import our CSS
import '../sass/main.scss';

// javascript entry point
import './global.js';
import './search-autocomplete.js';

// Accept HMR as per: https://webpack.js.org/api/hot-module-replacement#accept
if (module.hot) {
  module.hot.accept();
}