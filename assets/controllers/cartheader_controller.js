import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    static targets = ['quantity'];

    setQuantity(quantity){
        this.quantityTarget.textContent = data.rowQuantity;


    }
}
