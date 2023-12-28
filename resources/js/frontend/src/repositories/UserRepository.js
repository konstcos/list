import useUser from "../../entities/UserEntity.js";
import userApi from "../../api/user.js";

const {setUser} = useUser();

export default class UserRepository {
  async getUser() {
    try {
      const result = await userApi.getUser();
      if (result['status'] === 'success') {
        setUser(result.data.user);
        return true;
      }
    } catch (error) {
      return false;
    }
  }
}

