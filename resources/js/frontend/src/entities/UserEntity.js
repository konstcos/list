import {reactive, toRefs} from "vue";

const state = reactive({
  user: {
    email: null,
    name: null,
    token: null,
  },
});

export default function useUser() {
  const setUser = (user) => {
    state.user.email = user.email;
    state.user.name = user.name;
  };

  const setToken = (token) => {
    state.user.token = token;
  }

  const isLoggedIn = () => {
    return !!state.user.token;
  };

  const clearUser = () => {
    state.user = {
      email: null,
      name: null,
      token: null,
    };
  };

  return {
    ...toRefs(state),
    setUser,
    clearUser,
    setToken,
    isLoggedIn,
  };
}
