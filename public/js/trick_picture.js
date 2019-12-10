$("#add-picture").click(function () {
    // Index of future fields that will be created
    const index = +$("#widget-counter").val();

    // Retrieving the prototype of the entries
    const template = $("#trick_pictures").data("prototype").replace(/__name__/g, index);

    // Inject the template into the div
    $("#trick_pictures").append(template);

    $("#widget-counter").val(index + 1);

    // Manages the delete button
    handleDeleteButtons();

    $('#trick_pictures_' + index + '_picture').on('change', function () {
        //get the file name
        let file = $(this).val();
        let fileName = file.split('\\');

        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName[2]);
    });
});

function handleDeleteButtons()
{
    $("button[data-action='delete']").click(function () {
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter()
{
    const count = +$("#trick_pictures div.form-group").length;

    $("#widget-counter").val(count);
}

updateCounter();
handleDeleteButtons();