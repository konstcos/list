import useUser from "../../entities/UserEntity.js";
import api from "../../api/auth.js";
import userApi from "../../api/user.js";

const {setUser, setToken, setLogged, clearUser} = useUser();


export default class LoginRepository {
  async login(email, password) {

    try {
      const result = await api.login(email, password);
      setToken(result.data.token);
      const getUserResult = await userApi.getUser();

      if (getUserResult['status'] === 'success') {
        setUser(getUserResult.data.user);
        setLogged(true);
        return true;
      }
    } catch (error) {
      console.error('error', error);
      return false;
    }
  }

  async register(name, email, password) {
    try {
      const result = await api.register(name, email, password);
      if (result['status'] === 'success') {
        return result
      }
    } catch (error) {
      return {
        status: 'fail',
        info: 'error registration',
        data: {
          error: error,
        }
      };
    }
  }

  async checkAuth() {
    try {
      const result = await userApi.getUser();

      if (result['status'] === 'success') {
        setUser(result.data.user);
        setLogged(true);
        return true;
      }
    } catch (error) {
      clearUser();
      return false;
    }
  }

  logout() {
    try {
      api.logout();
      return true;
    } catch (error) {
      console.log('error', error);
      return false;
    } finally {
      clearUser();
    }
  }

}
