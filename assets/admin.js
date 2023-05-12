import TomSelect from 'tom-select'
import 'tom-select/dist/css/tom-select.bootstrap4.min.css';




document.addEventListener('DOMContentLoaded',function () {
    Array.from(document.querySelectorAll('select[multiple]')).forEach((select) => {
        new TomSelect(select, {})
    })
})
