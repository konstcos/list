import walletApi from '../../../api/wallet.js';
import WalletEntity from '../entities/WalletEntity.js';

export default class WalletRepository {
  async getUserWallets() {
    try {
      const result = await walletApi.getUserWallets();
      if (result['status'] === 'success') {
        return result;
      }
    } catch (error) {
      return false;
    }
  }

  /**
   * 
   * @param WalletEntity wallet
   */
  async saveWallet(wallet) {
    try {
      const result = await walletApi.saveWallet({
        id: wallet.id,
        name: wallet.name,
        description: wallet.description,
        balance: wallet.balance,
      });
      if (result['status'] === 'success') {
        return result;
      }
    } catch (error) {
      return false;
    }
  }
}
