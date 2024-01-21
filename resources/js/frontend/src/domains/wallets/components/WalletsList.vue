<template>
  <div>
    <div>
      <VCard>
        <VCardText>
          <VRow class="mb-3">
            <VCol>
              <v-btn :loading="loading" @click="loadWallets" color="primary" density="compact" icon="mdi:mdi-reload"></v-btn>
            </VCol>
            <VCol class="text-end">
              <v-btn @click="openWalletEditor" :disabled="loading" density="compact" icon="mdi:mdi-plus"></v-btn>
            </VCol>
          </VRow>
          <div v-if="loading">
            <v-progress-linear indeterminate color="primary"></v-progress-linear>
          </div>

          <div v-if="!loading && wallets.length === 0" class="text-center">
            у вас пока нет кошельков
          </div>

        </VCardText>
      </VCard>
    </div>

    <WalletEditor v-model="walletEditorModal" />

  </div>
</template>

<script>
import WalletRepository from "../repositories/WalletRepository.js";
import WalletEditor from "./WalletEditor.vue";

export default {
  name: "WalletsList",
  setup() {
    const walletRepository = new WalletRepository();
    return {walletRepository};
  },
  components: {
    WalletEditor
  },
  data() {
    return {
      wallets: [],
      loading: false,
      walletEditorModal: false,
    }
  },
  methods: {
    async loadWallets() {
      this.loading = true;
      const result = await this.walletRepository.getUserWallets();

      console.log('result', result);

      this.loading = false;
    },
    openWalletEditor() {
      this.walletEditorModal = true;
    }
  },
  mounted() {
    this.loadWallets();
  }
}
</script>

<style scoped lang="scss">

</style>
