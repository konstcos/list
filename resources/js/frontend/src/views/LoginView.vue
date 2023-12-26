<template>
  <div class="main_login_block">
    <div class="text-center login_title">Вход</div>
    <div>
      <v-card
        color="indigo"
        variant="outlined"
      >

        <v-card-text class="pt-6">
          <v-form>
            <v-text-field
              v-model="login"
              label="Логин"
              density="compact"
              required
            ></v-text-field>
            <v-text-field
              v-model="password"
              label="Пароль"
              density="compact"
              required
            ></v-text-field>
            <v-btn
              color="primary"
              size="small"
              @click="loginUser"
            >Войти
            </v-btn>
          </v-form>

        </v-card-text>
      </v-card>

      <div class="text-center mt-4">
        <v-btn
          size="small"
        >
          Регистрация
        </v-btn>
      </div>

    </div>
  </div>
</template>

<script>
// import useUser from '@/src/entities/UserEntity.js';
import useUser from '../entities/UserEntity.js';

export default {
  name: "LoginView",
  setup() {
    const {setToken, clearUser, user} = useUser()

    return {
      setToken,
      clearUser,
      user,
    }
  },
  data() {
    return {
      login: "",
      password: "",
    };
  },
  methods: {
    loginUser() {
      console.log(this.login, this.password);
      this.setToken("1234567890");
    },

  },
}
</script>


<style scoped lang="scss">
.main_login_block {
  width: 300px;
  margin: 5% auto 0;
}

.login_title {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 10px;
}

</style>
