import axios from '../utils/axios.js'

export default {

  async getUser() {
    const result =  await axios.post('user', {});
    return result.data;
  },
}
