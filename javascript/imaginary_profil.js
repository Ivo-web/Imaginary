let block = document.getElementById('block-regles');

let parent = document.body;

block.addEventListener('click', function() {

    parent.removeChild(block);

});