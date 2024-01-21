<template>
  <div>
    <h1>Мои кошельки</h1>
    <div class="mt-4">
      <VRow>
        <VCol cols="4">
          <WalletsList></WalletsList>
        </VCol>
      </VRow>

    </div>
  </div>
</template>

<script>
import WalletsList from "../domains/wallets/components/WalletsList.vue";
export default {
  name: "Wallets",
  components: {
    WalletsList,
  }
}
</script>


<style scoped lang="scss">

</style>
