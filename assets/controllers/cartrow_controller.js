import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    remove(event){
        fetch(
            '/cart/'+event.params.productid,
            {
                method:'DELETE'
            }
        )
        .then(() => {
            this.element.remove();
            
        });
    }

}
