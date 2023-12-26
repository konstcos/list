import axios from "axios";

const defaultTransformers = () => {
  const {transformRequest} = axios.defaults;
  if (!transformRequest) {
    return [];
  } else if (transformRequest instanceof Array) {
    return transformRequest;
  } else {
    return [transformRequest];
  }
};

const config = {
  // baseURL: import.meta.env.MODE === 'production' ? 'https://api.example.com' : 'http://localhost:8000',
  baseURL: 'https://list.loc/api',
  method: 'post',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  },
  transformRequest: [
    (data, headers) => {
      const token = null; // get token from local storage or where ever you have stored it.

      if (token) {
        data.token = token;
        headers['Authorization'] = 'Bearer ' + token;
      }

      return data;
    },
    ...defaultTransformers(),
  ],
}

export default axios.create(config);
