
export default class LinkEntity {

    id = 0;
    link = '';


    constructor(data = {}) {
        this.id = data.id ?? 0;
        this.link = data.link ?? '';
    }

    clear() {
        // this.id = 0;
        this.link = '';

    }
}
