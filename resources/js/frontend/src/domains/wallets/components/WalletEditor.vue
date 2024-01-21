<template>
    <div>
        <!-- <v-btn @click="openModal">Open Modal</v-btn> -->
        <v-dialog v-model="modalOpen" max-width="500px" @click:outside="closeModal">
            <v-card>
                <v-card-title>
                    <span class="headline">Создание нового кошелька</span>
                </v-card-title>
                <v-card-text v-if="modalOpen">
                    <div v-if="wallet">
                        <v-text-field v-model="wallet.name" label="Name"></v-text-field>
                        <v-textarea v-model="wallet.description" label="Description"></v-textarea>
                    </div>
                    <div v-else>
                        загрузка...
                    </div>

                </v-card-text>

                <v-card-actions>
                    <v-btn density="compact" color="primary" @click="closeModal">Закрыть</v-btn>

                    <v-spacer></v-spacer>
                    <v-btn density="compact" color="primary" @click="saveWallet">Сохранить</v-btn>
                    <!-- Added save button -->
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import WalletRepository from "../repositories/WalletRepository.js";
import WalletEntity from "../entities/WalletEntity.js";


export default {
    name: 'WalletEditor',
    setup() {
        const walletRepository = new WalletRepository();
        return { walletRepository };
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
                console.log('mounted');
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
            console.log('saveWallet', this.wallet);
            const result = await this.walletRepository.saveWallet(this.wallet);
            console.log('result', result);
            // this.closeModal();

        },

        /**
         * Очищает данные кошелька.
         */
        clearWalletData() {
            if (this.wallet) {
                this.wallet.clear();
            }
        },

        loadWalletData() {
            if (this.walletId === 0) {
                console.log('loadWalletData new wallet', this.walletId);
                this.wallet = new WalletEntity();
            } else {
                console.log('loadWalletData', this.walletId);
            }
        }

    }
}
</script>

<style scoped>
/* Your styles here */
</style>
