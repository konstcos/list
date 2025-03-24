import axios from "axios";
import useUser from "../entities/UserEntity.js";

const {getToken} = useUser();

const rootDomain = window.location.hostname;
let scheme = window.location.protocol;

if (rootDomain === 'localhost') {
  scheme = 'https:';
}

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
  baseURL: import.meta.env.MODE === 'production' ? `${scheme}//${rootDomain}/api/v1` : `${scheme}//list.loc/api/v1`,
  method: 'post',
  withCredentials: true,
  credentials: 'include',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  },
  transformRequest: [
    (data, headers) => {
      const token = getToken();

      if (token) {
        // data.token = token;
        headers['Authorization'] = 'Bearer ' + token;
      }

      return data;
    },
    ...defaultTransformers(),
  ],
}

export default axios.create(config);
