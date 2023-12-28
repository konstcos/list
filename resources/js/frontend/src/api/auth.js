import axios from '../utils/axios.js'

export default {

  async login(email, password) {
    const result =  await axios.post('login', {email, password});
    return result.data;
  },

  async register(name, email, password) {
    const result = await axios.post('register', {name, email, password});
    return result.data;
  },

  async logout(name, email, password) {
    const result = await axios.post('logout', {});
    return result.data;
  },


}
