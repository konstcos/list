<template>
    <div>
        <!-- <v-btn @click="openModal">Open Modal</v-btn> -->
        <v-dialog v-model="modalOpen" max-width="500px" @click:outside="closeModal">
            <v-card>
                <v-card-title>
                    <span class="headline">Создание нового кошелька</span>
                </v-card-title>
                <v-card-text v-if="modalOpen">
                    
                    <div v-if="loading">
                        <v-progress-linear indeterminate color="primary"></v-progress-linear>
                    </div>

                    <div v-if="wallet">
                        <v-text-field v-model="wallet.name" label="Name"></v-text-field>
                        <v-textarea v-model="wallet.description" label="Description"></v-textarea>
                    </div>

                </v-card-text>

                <v-card-actions>
                    <v-btn density="compact" color="primary" @click="closeModal">Закрыть</v-btn>

                    <v-spacer></v-spacer>
                    <v-btn density="compact" color="primary" @click="saveWallet">Сохранить</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import WalletRepository from "../repositories/WalletRepository.js";
import WalletUseCase from "../use_case/WalletUseCase";
import WalletEntity from "../entities/WalletEntity.js";


export default {
    name: 'WalletEditor',
    setup() {
        const walletRepository = new WalletRepository();
        const walletUseCase = new WalletUseCase();
        return { walletRepository, walletUseCase };
    },
    props: {
        modelValue: {
            type: Boolean,
            default: false
        },
        walletId: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {
            modalOpen: this.value,
            wallet: null,
            loading: true,
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
                this.loadWalletData();
            }
        }
    },
    methods: {
        openModal() {
            this.modalOpen = true;
            this.clearWalletData();
        },
        closeModal() {
            this.modalOpen = false;
            this.$emit('update:modelValue', false);
        },

        /**
         * Сохраняет кошелек.
         */
        async saveWallet() {
            this.loading = true;
            const result = await this.walletRepository.saveWallet(this.wallet);
            this.loading = false;
            this.$emit('reload');
            this.closeModal();

        },

        /**
         * Очищает данные кошелька.
         */
        clearWalletData() {
            if (this.wallet) {
                this.wallet.clear();
            }
        },

        async getWalletData() {
            this.wallet = null;
            this.loading = true;

            const result = await this.walletUseCase.getWalletDetail(this.walletId);
            if (result === false) {
                alert('Ошибка при загрузке данных кошелька');
            } else {
                this.wallet = result;
            }

            this.loading = false;
        },

        loadWalletData() {
            if (this.walletId === 0) {
                this.wallet = new WalletEntity();
                this.loading = false;
            } else {
                this.getWalletData();
            }
        }

    }
}
</script>

<style scoped>
/* Your styles here */
</style>
