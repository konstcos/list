import WalletRepository from "../repositories/WalletRepository.js";
import WalletEntity from "../entities/WalletEntity.js";

export default class WalletUseCase {

    constructor() {
        this.walletRepository = new WalletRepository();
    }

    async getUserWallets() {
        try {
            const result = await this.walletRepository.getUserWallets();
            if (result['status'] === 'success') {
                let wallets = [];
                for(let wallet of result['data']['wallets']) {
                    wallets.push(new WalletEntity({
                        id: wallet.id,
                        name: wallet.name,
                        description: wallet.description,
                        balance: wallet.balance,
                    }));
                }

                return wallets;
            }
        } catch (error) {
            return false;
        }
    }

    async getWalletDetail(walletId) {
        try {
            const result = await this.walletRepository.getWalletDetail(walletId);
            if (result['status'] === 'success') {
                return new WalletEntity({
                    id: result['data']['wallet']['id'],
                    name: result['data']['wallet']['name'],
                    description: result['data']['wallet']['description'],
                    balance: result['data']['wallet']['balance'],
                });
            } else {
                return false;
            }
        } catch (error) {
            return false;
        }
    }

    async deleteWallet(walletId) {
        try {
            const result = await this.walletRepository.deleteWallet(walletId);
            if (result['status'] === 'success') {
                return true;
            } else {
                return false;
            }
        } catch (error) {
            return false;
        }
    }
}