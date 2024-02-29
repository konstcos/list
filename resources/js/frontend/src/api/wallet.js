import axios from '../utils/axios.js'
import WalletEntity from '../domains/wallets/entities/WalletEntity.js';

export default {

  async getUserWallets() {
    const result =  await axios.post('wallet/user-wallets', {});
    return result.data;
  },

  /**
   * 
   * @param number walletId 
   * @returns 
   */
  async getWalletDetail(walletId) {
    const result =  await axios.post('wallet/detail', {
      wallet_id: walletId
    });
    return result.data;
  },

  /**
   * 
   * @param WalletEntity wallet 
   * @returns 
   */
  async saveWallet(wallet) {
    const result =  await axios.post('wallet/save', wallet);
    return result.data;
  },

  async deleteWallet(walletId) {
    const result =  await axios.post('wallet/delete', {
      wallet_id: walletId
    });
    return result.data;
  }
}
