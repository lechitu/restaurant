/*
  Defines the API route we are using.
*/
var api_url = 'http://127.0.0.1:8000/api/v1';
var google_maps_js_api = 'AIzaSyBX-KfEwiT98OM_xpD3spX7ZfO3AZX0Xdw';

/*
  Depending on the environment, define the API URL.
*/
switch (process.env.NODE_ENV) {
  case 'development':
    api_url = 'http://127.0.0.1:8000/api/v1';
    break;
  case 'production':
    api_url = 'http://127.0.0.1/api:8000/v1';
    break;
}

/*
  Export the roast URL configuration.
*/
export const ROAST_CONFIG = {
  API_URL: api_url,
  GOOGLE_MAPS_JS_API: google_maps_js_api
}
