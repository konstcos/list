<template>
  <div>
    <v-dialog v-model="modalOpen" max-width="500px" @click:outside="closeModal">
      <v-card>
        <v-card-title>
          <span class="headline">Линк</span>
        </v-card-title>
        <v-card-text v-if="modalOpen">

          <div v-if="loading">
            <v-progress-linear indeterminate color="primary"></v-progress-linear>
          </div>

          <div v-if="linkEditor">
            <v-textarea v-model="linkEditor.link" label="Link" rows="2"></v-textarea>
          </div>

        </v-card-text>

        <v-card-actions>
          <v-btn density="compact" color="primary" @click="closeModal">Закрыть</v-btn>

          <v-spacer></v-spacer>
          <v-btn density="compact" color="primary" @click="saveLink">Сохранить</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import LinkRepository from "../repositories/LinksRepository.js";
import LinkUseCase from "../use_case/LinksUseCase.js";
import LinkEntity from "../entities/LinkEntity.js";


export default {
  name: 'LinkEditor',
  setup() {
    const linkRepository = new LinkRepository();
    const linkUseCase = new LinkUseCase();
    return {linkRepository, linkUseCase};
  },
  props: {
    modelValue: {
      type: Boolean,
      default: false
    },
    link: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      modalOpen: this.value,
      linkEditor: {
        id: 0,
        link: ''
      },
      loading: false,
    }
  },
  watch: {
    modelValue(newValue) {
      if (newValue) {
        this.openModal();
      } else {
        this.closeModal();
      }
    },
    modalOpen(newValue) {
      if (newValue) {
        this.linkEditor.id = this.link.id;
        this.linkEditor.link = this.link.link;
      }
    }
  },
  methods: {
    openModal() {
      this.modalOpen = true;
      this.clearLinkData();
    },
    closeModal() {
      this.modalOpen = false;
      this.$emit('update:modelValue', false);
    },

    /**
     * Сохраняет кошелек.
     */
    async saveLink() {
      // console.log('saveLink');
      this.loading = true;
      const result = await this.linkRepository.saveLink(new LinkEntity({
        id: this.linkEditor.id,
        link: this.linkEditor.link
      }));
      this.loading = false;
      this.$emit('reload');
      this.closeModal();

    },

    /**
     * Очищает данные кошелька.
     */
    clearLinkData() {
      this.linkEditor = {
        id: 0,
        link: ''
      };
    },

    // async getLinkData() {
    //     this.link = null;
    //     this.loading = true;
    //
    //     // const result = await this.walletUseCase.getWalletDetail(this.walletId);
    //     // if (result === false) {
    //     //     alert('Ошибка при загрузке данных кошелька');
    //     // } else {
    //     //     this.wallet = result;
    //     // }
    //
    //     this.loading = false;
    // },

    // loadWalletData() {
    //     if (this.walletId === 0) {
    //         this.link = new LinkEntity();
    //         this.loading = false;
    //     } else {
    //         this.getLinkData();
    //     }
    // }

  }
}
</script>

<style scoped>
/* Your styles here */
</style>
