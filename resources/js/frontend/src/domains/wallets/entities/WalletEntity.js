
export default class WalletEntity {

    id = 0;
    name = '';
    description = '';
    сurrency = '';
    balance = 0;

    constructor(data = {}) {
        this.id = data.id ?? 0;
        this.name = data.name ?? '';
        this.description = data.description ?? '';
        this.balance = data.balance ?? 0;
    }

    clear() {
        // this.id = 0;
        this.name = '';
        this.description = '';
        this.balance = 0;
    }
}