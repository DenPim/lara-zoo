const newPetButton = document.querySelector(".new-pet-button");
const newPetBlock = document.querySelector(".new-pet-block");

$.getJSON('http://lara.denpin.ru/api/animal_kinds', function( data ) {
    data.forEach(animal => {

        $('<div/>',{
            html: '<img src="images/' + animal.kind + '.svg" height="21px">',
            class: 'new-pet pointer',
            "onclick": "newPet('" + animal.kind + "')",
            "data-kind": animal.kind
        }).appendTo('.new-pet-block');

    });
},);

newPetButton.addEventListener('click', event => {

    if (newPetBlock.classList.contains("hidden")) {
        newPetBlock.classList.remove("hidden");
        newPetButton.style.WebkitTransitionDuration='0.5s';
        newPetButton.style.transform = "rotate(45deg)";
    } else {
        newPetBlock.classList.add("hidden");
        newPetButton.style.transform = "rotate(0deg)";
    }

});

function newPet( animalKind ){
    $.ajax({
        url: 'http://lara.denpin.ru/api/animals',
        method: 'post',
        dataType: 'JSON',
        data: {kind: animalKind}
    });
    setTimeout(() => { updatePets(); }, 100);
};

function updatePets(){
    $(".pets").html("");

    $.getJSON('http://lara.denpin.ru/api/animals', function( data ) {
        data.forEach(animal => {

            var size = animal.size + 10;
            var disableKind = document.querySelector("[data-kind='" + animal.kind + "']");

            $('<div/>',{
                html: '<img src="images/' + animal.kind + '.svg" width="' + size + '%">',
                class: 'pet',
                "data-name": animal.name
            }).appendTo('.pets');

            disableKind.classList.remove("pointer");
            disableKind.classList.add("disabled-pet");
            disableKind.removeAttribute("onclick");

        });
    },);
}

function agePets(){

    var allPets = document.querySelectorAll(".pet");
    if (allPets) {

        allPets.forEach(function (animal) {
            $.ajax({
                url: 'http://lara.denpin.ru/api/animals/age',
                method: 'post',
                dataType: 'JSON',
                data: {name: animal.dataset.name}
            });
        });

        updatePets();
        
    }
    setTimeout(() => { agePets(); }, 10000);
}

updatePets();
setTimeout(() => { agePets(); }, 10000);