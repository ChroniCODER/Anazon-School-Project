import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    static targets = ['quantity'];

    remove(event){
        fetch(
            '/cart/'+event.params.productid,
            {
                method:'DELETE'
            }
        )
        .then((data) => {
            this.element.remove();
            let cartHeaderController = this.application.getControllerForElementAndIdentifier(document.querySelector('[data-controller="cartheader"]'), 'cartheader')
            cartHeaderController.setQuantity(data.totalQuantity);
        });
    }

    increment(event){
        fetch(
            '/cart/'+event.params.productid+'/increment',
            {
                method:'POST'
            }
        )
        .then((response) => response.json())
        .then((data) => {
            let cartHeaderController = this.application.getControllerForElementAndIdentifier(document.querySelector('[data-controller="cartheader"]'), 'cartheader')
            cartHeaderController.setQuantity(data.totalQuantity);
            this.quantityTarget.textContent = data.rowQuantity;
        });
    }

    decrement(event){
        fetch(
            '/cart/'+event.params.productid+'/decrement',
            {
                method:'POST'
            }
        )
        .then((response) => response.json())
        .then((data) => {
            let cartHeaderController = this.application.getControllerForElementAndIdentifier(document.querySelector('[data-controller="cartheader"]'), 'cartheader')
            cartHeaderController.setQuantity(data.totalQuantity);
            this.quantityTarget.textContent = data.rowQuantity;

            if(data.rowQuantity == 0){
                this.element.remove();
            }
        });
    }

}
