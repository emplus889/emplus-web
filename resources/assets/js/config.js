var api_url = '';

switch( process.env.NODE_ENV){
  case 'development':
    api_url = 'https://emplus-web.herokuapp.com/';
  break;
  case 'production': 
    api_url = 'https://emplus-web.herokuapp.com/'; //TODO: change with production url
  break;   
}

export const EMPLUS_CONFIG = {
  API_URL: api_url,
}