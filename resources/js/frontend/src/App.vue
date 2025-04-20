<template>
  <v-app class="main_app_block">
    <v-app-bar density="compact">
      <template v-slot:prepend>
        <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      </template>

      <v-app-bar-title>Мои списки</v-app-bar-title>

      <template v-slot:append>
        <!--        <v-btn icon="mdi:mdi-dots-vertical"></v-btn>-->

        <div>
          <b>{{ user.name }}</b>
        </div>

        <v-menu v-if="isLoggedIn()">
          <template v-slot:activator="{ props }">
            <v-btn :loading="checkAuthLoading" icon="mdi:mdi-account" v-bind="props"></v-btn>
          </template>

          <v-list>
            <v-list-item
              prepend-icon="mdi:mdi-logout"
              title="Выйти"
              @click="logoutUser()"
            ></v-list-item>
          </v-list>

        </v-menu>

        <v-btn v-else icon="mdi:mdi-login" :loading="checkAuthLoading" to="/login"></v-btn>
        <!--        <v-btn icon="mdi:mdi-logout"></v-btn>-->
      </template>

    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      :rail="rail"
      permanent
    >
      <v-list
        v-model:opened="open"
        density="compact"
        nav>
        <v-list-item
          prepend-icon="mdi:mdi-home-city"
          title="Home"
          value="home"
          to="/"
        />

        <v-list-group
          v-if="isLoggedIn()"
          value="Tagging"
        >

          <template v-slot:activator="{ props }">
            <v-list-item
              v-bind="props"
              prepend-icon="mdi:mdi-tag-multiple"
              title="Tagging"
            />

          </template>

          <v-list-item
            title="Categories"
            value="categories"
            to="/categories"
          />

        </v-list-group>




        <v-list-item
          prepend-icon="mdi:mdi-file-cabinet"
          title="Base"
          value="base"
          to="/base"
        />
        <v-list-item
          v-if="isLoggedIn()"
          prepend-icon="mdi:mdi-wallet"
          title="Кошельки"
          value="wallets"
          to="/wallets"
        />
        <v-list-item
          v-if="isLoggedIn()"
          prepend-icon="mdi:mdi-cash-fast"
          title="Переводы"
          value="transactions"
          to="/transactions"
        />
        <v-list-item
          v-if="isLoggedIn()"
          prepend-icon="mdi:mdi-link-box-outline"
          title="Ссылки"
          value="links"
          to="/links"
        />
      </v-list>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn
            variant="text"
            :icon="rail ? 'mdi:mdi-chevron-right' : 'mdi:mdi-chevron-left'"
            @click="rail = !rail"
          >
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-main>
      <v-container fluid>
        <router-view v-if="!checkAuthLoading" />
      </v-container>
    </v-main>


  </v-app>
</template>

<script>
import useUser from './entities/UserEntity.js';
import LoginRepository from "./repositories/auth/LoginRepository.js";

export default {
  name: 'App',
  setup() {
    const {isLoggedIn, user} = useUser();
    const loginRepository = new LoginRepository();
    return {
      isLoggedIn,
      loginRepository,
      user,
    };
  },
  data: () => ({
      open: ['Tagging'],
      taggingOpen: true,
      drawer: true,
      rail: false,
      checkAuthLoading: true,
  }),
  methods: {
    preventGroupClose(val) {
      if (!val.includes('Tagging')) {
        this.open = [...val, 'Tagging']
      } else {
        this.open = val
      }
    },
    async clearUser() {
      this.loginRepository.logout();
    },
    async checkAuth() {
      this.checkAuthLoading = true;
      await this.loginRepository.checkAuth();
      this.checkAuthLoading = false;

      if (this.$route.name === 'login' && this.isLoggedIn()) {
        this.$router.push({name: 'home'});
      }

      if ((
          this.$route.name === 'wallets' ||
          this.$route.name === 'transactions'
        ) &&
        !this.isLoggedIn()
      ) {
        this.$router.push({name: 'home'});
      }
    },
    logoutUser() {
      this.loginRepository.logout();
      this.$router.push({name: 'home'});
    }
  },
  mounted() {
    this.checkAuth();

  }
}
</script>

<style scoped lang="scss">


</style>
