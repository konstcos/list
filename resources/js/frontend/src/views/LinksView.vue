<template>
  <div>
    <h1>Каталог ссылок</h1>
    <div class="mt-4">

      <v-row>
        <v-col>
          <v-text-field
            density="compact"
            v-model="newLink"
          ></v-text-field>
        </v-col>
        <v-col>
          <v-btn
            size="small"
            @click="saveLink()"
            color="primary"
          >
            Сохранить
          </v-btn>
          <v-btn
            class="ml-2"
            size="small"
            @click="newLink = null"
          >
            Очистить
          </v-btn>
        </v-col>
      </v-row>



      <div v-if="loading">
        Загрузка...
      </div>

      <div>
        <div v-for="link in links" :key="link.id">
          <v-row>
            <v-col>
              <div class="link-id">
                {{ link.id }}
              </div>

              <a class="" :href="link.link" target="_blank">{{ link.link }}</a>

              <v-btn
                class="ml-3"
                size="x-small"
                @click="openLinkEditor(link.id)"
                :disabled="loading"
                density="compact"
                variant="text"
                icon="mdi:mdi-pencil">
              </v-btn>

              <v-btn
                class="ml-3"
                size="x-small"
                @click="openDeleteLinkModal(link)"
                :disabled="loading"
                density="compact"
                variant="text"
                icon="mdi:mdi-delete">
              </v-btn>

            </v-col>
          </v-row>
        </div>
      </div>

    </div>

    <LinkEditor v-model="linkEditorModal.show" :link-id="linkEditorModal.linkId" @reload="loadLinks()"/>

    <v-dialog v-model="deleteLinkModal.show" max-width="500px" @click="deleteLinkModal.show = false">
      <v-card>
        <v-card-title>
          <span class="headline">Удаление линка</span>
        </v-card-title>
        <v-card-text>
          <div>
            Уверены что хотите удалить линк?
          </div>

        </v-card-text>

        <v-card-actions>
          <v-btn density="compact" color="primary" @click="deleteLinkModal.show = false">Закрыть</v-btn>

          <v-spacer></v-spacer>
          <v-btn density="compact" color="error" @click="saveLink">Удалить</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </div>
</template>

<script>
import LinksUseCase from "../domains/links/use_case/LinksUseCase.js";
import LinkEditor from "../domains/links/components/LinkEditor.vue";

export default {
  name: "Links",
  components: {
    LinkEditor
  },
  setup() {
    const linksUseCase = new LinksUseCase();
    return { linksUseCase };
  },
  data() {
    return {
      links: [],
      loading: false,
      newLink: null,
      linkEditorModal: {
        show: false,
        linkId: 0
      },
      deleteLinkModal: {
        show: false,
        linkId: 0
      },
    }
  },
  methods: {
    async saveLink() {
      if (this.newLink && this.newLink.trim().length === 0) {
        return false;
      }

      await this.linksUseCase.saveLink(this.newLink);

      this.loadLinks();
    },
    openLinkEditor(linkId = 0) {
      this.linkEditorModal.linkId = linkId;
      this.linkEditorModal.show = true;
    },
    async loadLinks() {
      this.loading = true;
      this.links = await this.linksUseCase.getUserLinks();
      this.loading = false;
    },
    openDeleteLinkModal(link) {
      this.deleteLinkModal.linkId = link.id;
      this.deleteLinkModal.show = true;
    },
  },
  mounted() {
    this.loadLinks();
  }
}
</script>


<style scoped lang="scss">

.link-id {
  width: 30px;
  display: inline-block;
}

</style>
