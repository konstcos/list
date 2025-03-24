import linksApi from '../../../api/links.js';
import LinkEntity from '../entities/LinkEntity.js';


export default class WalletRepository {
  async getUserLinks() {
    try {
      return await linksApi.getUseLinks();
    } catch (error) {
      return false;
    }
  }

  async saveLink(link) {
    try {
      return await linksApi.saveLink(link);
    } catch (error) {
      return false;
    }
  }

  async deleteLink(link) {
    try {
      return await linksApi.deleteLink(link);
    } catch (error) {
      return false;
    }
  }

}
