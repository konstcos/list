import LinksRepository from "../repositories/LinksRepository.js";
import LinkEntity from "../entities/LinkEntity.js";

export default class LinksUseCase {

    constructor() {
        this.linksRepository = new LinksRepository();
    }

    async getUserLinks() {
        try {
            const result = await this.linksRepository.getUserLinks();
            if (result['status'] === 'success') {
                let links = [];
                for(let link of result['data']['links']) {
                    links.push(new LinkEntity({
                        id: link.id,
                        link: link.link,
                    }));
                }

                return links;
            }

            return [];
        } catch (error) {
            return false;
        }
    }


    async saveLink(link) {
        try {
            const result = await this.linksRepository.saveLink(link);
            return result;
        } catch (error) {
            return false;
        }
    }



}
