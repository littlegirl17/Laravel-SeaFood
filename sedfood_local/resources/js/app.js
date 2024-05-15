import './bootstrap';


document.addEventListener('DOMContentLoaded', function(){
    console.log('load1');
})

document.addEventListener('livewire:navigated', ()=>{
    console.log('load2');

    initFlowbite();
});
