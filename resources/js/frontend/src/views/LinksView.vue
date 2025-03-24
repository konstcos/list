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
                @click="openLinkEditor(link)"
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

    <LinkEditor v-model="linkEditorModal.show" :link="linkEditorModal.link" @reload="loadLinks()"/>

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
          <v-btn density="compact" color="error" @click="deleteLink">Удалить</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </div>
</template>

<script>
import LinksUseCase from "../domains/links/use_case/LinksUseCase.js";
import LinkEditor from "../domains/links/components/LinkEditor.vue";
import LinkEntity from "../domains/links/entities/LinkEntity.js";

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
        link: {}
      },
      deleteLinkModal: {
        show: false,
        link: null
      },
    }
  },
  methods: {
    async saveLink() {
      if (this.newLink && this.newLink.trim().length === 0) {
        return false;
      }



      await this.linksUseCase.saveLink(new LinkEntity({
        id: 0,
        link: this.newLink
      }));
      this.newLink = null;

      this.loadLinks();
    },
    openLinkEditor(link = null) {
      this.linkEditorModal.link = link || new LinkEntity();

      this.linkEditorModal.show = true;
    },
    async loadLinks() {
      this.loading = true;
      this.links = await this.linksUseCase.getUserLinks();
      this.loading = false;
    },
    openDeleteLinkModal(link) {
      this.deleteLinkModal.link = link;
      this.deleteLinkModal.show = true;
    },
    async deleteLink() {
      if (this.deleteLinkModal && !this.deleteLinkModal.link) {
        return false;
      }

      await this.linksUseCase.deleteLink(this.deleteLinkModal.link);

      this.loadLinks();
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
