<template>
  <div class="main_login_block">
    <div v-if="section === sections.login">
      <div class="login_title">
        Вход
        <v-btn
          size="small"
          @click="changeSection(sections.registration)"
          :disabled="loading"
        >
          Зарегистрироваться
        </v-btn>
      </div>
      <div>
        <v-card
          color="indigo"
          variant="outlined"
        >

          <v-card-text class="pt-6">
            <v-form>
              <v-text-field
                v-model="login.email"
                label="Email"
                density="compact"
                required
                :disabled="loading"
              ></v-text-field>
              <v-text-field
                v-model="login.password"
                label="Пароль"
                type="password"
                density="compact"
                required
                :disabled="loading"
              ></v-text-field>
              <v-btn
                color="primary"
                size="small"
                @click="loginUser"
                :loading="loading"
              >Войти
              </v-btn>
            </v-form>

          </v-card-text>
        </v-card>

      </div>
    </div>
    <div v-else>
      <div class="login_title">
        Регистрация
        <v-btn
          size="small"
          @click="changeSection(sections.login)"
          :disabled="loading"
        >
          Войти
        </v-btn>
      </div>
      <div>
        <v-card
          color="indigo"
          variant="outlined"
        >

          <v-card-text class="pt-6">
            <v-form>
              <v-text-field
                v-model="registration.name"
                label="Name"
                density="compact"
                type="text"
                required
                :disabled="loading"
              ></v-text-field>
              <v-text-field
                v-model="registration.email"
                label="Email"
                type="email"
                density="compact"
                required
                :disabled="loading"
              ></v-text-field>
              <v-text-field
                v-model="registration.password"
                label="Пароль"
                density="compact"
                type="password"
                required
                :disabled="loading"
              ></v-text-field>
              <v-text-field
                v-model="registration.passwordConfirmation"
                label="Подтверждение пароля"
                density="compact"
                type="password"
                required
                :disabled="loading"
              ></v-text-field>

              <div v-if="error" class="mb-4 error_block">
                {{ error }}
              </div>

              <v-btn
                color="primary"
                size="small"
                @click="registerUser"
                :loading="loading"
              >Зарегистрироваться
              </v-btn>
            </v-form>

          </v-card-text>
        </v-card>
      </div>
    </div>

  </div>
</template>

<script>
// import useUser from '@/src/entities/UserEntity.js';
import useUser from '../entities/UserEntity.js';
import LoginRepository from "../repositories/auth/LoginRepository.js";

export default {
  name: "LoginView",
  setup() {
    const {setToken, clearUser, user} = useUser()
    const loginRepository = new LoginRepository();
    return {
      setToken,
      clearUser,
      user,
      loginRepository,
    }
  },
  data() {
    return {
      section: "login",
      sections: {
        login: "login",
        registration: "registration",
      },
      error: false,
      loading: false,
      login: {
        email: "",
        password: "",
      },
      registration: {
        name: "",
        email: "",
        password: "",
        passwordConfirmation: "",
      },

    };
  },
  methods: {
    async loginUser() {
      this.clearError();

      this.loading = true;
      const result = await this.loginRepository.login(this.login.email, this.login.password);

      if (result) {
        this.$router.push({name: 'home'});
      }

      this.loading = false;
    },

    async registerUser() {
      this.clearError();

      if (!this.checkRegistrationData()) {
        return;
      }

      this.loading = true;
      const result = await this.loginRepository.register(this.registration.name, this.registration.email, this.registration.password);

      if (result.status === 'success') {
        this.$router.push({name: 'home'});
      }

      this.loading = false;
    },
    changeSection(section) {
      this.clearError();
      this.clearLoginData();
      this.clearRegistrationData();
      this.section = section;
    },

    checkRegistrationData() {
      if (this.registration.email === '') {
        this.error = 'Введите email';
        return false;
      }
      if (this.registration.password === '') {
        this.error = 'Введите пароль';
        return false;
      }
      if (this.registration.passwordConfirmation === '') {
        this.error = 'Введите подтверждение пароля';
        return false;
      }

      if (this.registration.password !== this.registration.passwordConfirmation) {
        this.error = 'Пароли не совпадают';
        return false;
      }

      return true;
    },

    clearError() {
      this.error = false;
    },

    clearRegistrationData() {
      this.registration.name = '';
      this.registration.email = '';
      this.registration.password = '';
      this.registration.passwordConfirmation = '';
    },

    clearLoginData() {
      this.login.email = '';
      this.login.password = '';
    }

  },
  mounted() {

  }
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

.error_block {
  color: red;
  font-size: 12px;
  font-weight: 500;
  margin-bottom: 10px;
}

</style>
