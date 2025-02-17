<template>
  <div>
    <div>
      <VCard>
        <VCardText>
          <VRow class="mb-3">
            <VCol>
              <v-btn :loading="loading" @click="loadWallets" color="primary" density="compact"
                icon="mdi:mdi-reload"></v-btn>
            </VCol>
            <VCol class="text-end">
              <v-btn @click="openWalletEditor(0)" :disabled="loading" density="compact" icon="mdi:mdi-plus"></v-btn>
            </VCol>
          </VRow>

          <div v-if="loading">
            <v-progress-linear indeterminate color="primary"></v-progress-linear>
          </div>

          <div v-if="!loading && wallets.length === 0" class="text-center">
            у вас пока нет кошельков
          </div>

          <div v-if="wallets.length > 0" class="mt-3">

            <v-list-item v-for="wallet of wallets" :key="wallet.id" variant="elevated" class="mb-3"
            >

              <v-list-item-title @click="showWalletDetail(wallet.id)">
                {{ wallet.balance }} грн
              </v-list-item-title>

              <v-list-item-subtitle @click="showWalletDetail(wallet.id)">
                {{ wallet.name }}
              </v-list-item-subtitle>

              <template v-slot:append>
                <!-- <v-btn color="grey-lighten-1" icon="mdi:mdi-dots-vertical" variant="text"></v-btn> -->

                <template v-if="deleteWalletModal.show && deleteWalletModal.walletId === wallet.id"> 
                  <v-btn size="x-small" @click="cancelDelation()" :disabled="deleteWalletModal.loading">отмена</v-btn>
                  <v-btn size="x-small" @click="makeDeleteWallet()" class="ml-1" color="red-accent-4" :loading="deleteWalletModal.loading">удалить</v-btn>
                </template>

                <v-menu v-else>
                  <template v-slot:activator="{ props }">
                    <v-btn icon="mdi:mdi-dots-vertical" v-bind="props" color="grey-lighten-1" variant="text"></v-btn>
                  </template>

                  <v-list class="text-center">
                    <v-list-item>
                      <v-list-item-title>
                        <v-btn density="compact" @click="openWalletEditor(wallet.id)">
                          Редактировать
                        </v-btn>
                      </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>
                        <v-btn density="compact" @click="deleteWallet(wallet.id)" color="red-accent-4">
                          Удалить
                        </v-btn>
                      </v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>


              </template>
            </v-list-item>

          </div>

        </VCardText>
      </VCard>
    </div>

    <WalletEditor v-model="walletEditorModal.show" :wallet-id="walletEditorModal.walletId" @reload="loadWallets()"/>

  </div>
</template>

<script>
import WalletRepository from "../repositories/WalletRepository.js";
import WalletUseCase from "../use_case/WalletUseCase";
import WalletEditor from "./WalletEditor.vue";

export default {
  name: "WalletsList",
  setup() {
    const walletRepository = new WalletRepository();
    const walletUseCase = new WalletUseCase();
    return { walletRepository, walletUseCase };
  },
  components: {
    WalletEditor
  },
  data() {
    return {
      wallets: [],
      loading: false,
      walletEditorModal: {
        show: false,
        walletId: 0
      },
      deleteWalletModal: {
        show: false,
        walletId: 0,
        loading: false,
      }
    }
  },
  methods: {
    async loadWallets() {
      this.loading = true;
      const result = await this.walletUseCase.getUserWallets();

      if (result === false) {
        alert("Ошибка при загрузке кошельков");
      } else {
        this.wallets = result;
      }

      this.loading = false;
    },
    openWalletEditor(walletId = 0) {
      this.walletEditorModal.walletId = walletId;
      this.walletEditorModal.show = true;
    },
    showWalletDetail(walletId) {
      console.log('showWalletDetail', walletId);
    },
    deleteWallet(walletId) {
      this.deleteWalletModal.walletId = walletId;
      this.deleteWalletModal.show = true;
    },
    cancelDelation() {
      this.deleteWalletModal.show = false;
      this.deleteWalletModal.walletId = 0;
    },
    async makeDeleteWallet() {
      this.deleteWalletModal.loading = true;

      const result = await this.walletUseCase.deleteWallet(this.deleteWalletModal.walletId);
      
      if (result === false) {
        alert("Ошибка при удалении кошелька");
      } else {
        this.loadWallets();
      }

      this.deleteWalletModal.loading = false;
      this.deleteWalletModal.show = false;
    }
  },
  mounted() {
    this.loadWallets();
  }
}
</script>

<style scoped lang="scss"></style>
