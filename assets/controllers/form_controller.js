import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    connect() {

const btn= document.createElement('button')
btn.setAttribute('class', 'btn btn-secondary')
btn.innerText = 'Ajouter un élément'
btn.setAttribute('type', 'button')
btn.addEventListener('click', this.addElement)
this.element.append(btn)
}
/**
 * @param {MouseEvent} e
 */
addElement = (e) => {
e.preventDefault()
}
        
}
 