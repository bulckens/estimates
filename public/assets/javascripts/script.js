/* global jQuery */

jQuery(function ($) {
    var $buttons = $('input[type="button"]'),
        $sections = $('#offerteaanvraag').find('section'),
        $stappen = $('.stap-nummer'),
        $input_number = $('input[type="number"]');

    // Active styling op input[type="number"] 
    $input_number.on('focus', function () {
        $(this).parent('.numberfield').addClass('active')
    })

    // Buttons horen niet tot het input[type="number"] veld daarom valt de focus weg
    // Met deze functie wordt de focus altijd terug toegevoegd bij een klik op button
    // Ook de functionaliteit voor het optellen en aftrekken van het de value zit hier in
    $('.numberfield-button').on('click', function () {
        var $this_button = $(this),
            $number = $this_button.siblings('input[type=number]').val();
        
        // Focus zetten
        $this_button.siblings('input[type=number]').focus();

        // Aftrekfunctie
        if ($this_button.hasClass('button-minus')) {
            if ($number > 0) {
                $number = parseInt($number)
                $number = $number - 1
                $this_button.siblings('input[type=number]').val($number)
            } else if ($number === '') {
                $this_button.siblings('input[type=number]').val(0)
            } else {
                $this_button.siblings('input[type=number]').val(0)
            }
        }
        
        // Optelfunctie
        if ($this_button.hasClass('button-plus')) {
            if ($number === '') {
                $this_button.siblings('input[type=number]').val(1)
            } else {
                $number = parseInt($number)
                $number = $number + 1
                $this_button.siblings('input[type=number]').val($number)
            }
        }
        
        // Als dit groter is dan 1 geef extra opties in verband met verdeling
        if ($('#aantal_versies_input').val() > 1) {
            $('.oplage-verdeling').css('display', 'flex')
        } else {
            $('.oplage-verdeling').css('display', 'none')
        }
    })

    // Als de focus weg gaat op de button haal ook focus van het input[type="number"] veld
    $input_number.on('focusout', function () {
        $(this).parent('.numberfield').removeClass('active')
    })
    
    $('.upload-area').dropzone({url: "#"})
    
    $('.upload-area').on('dragover dragenter', function () {
                $('.upload-area').addClass('dragged')
            })
    $('.upload-area').on('dragleave dragend drop', function () {
                $('.upload-area').removeClass('dragged')
            })
    
    /*
    // Functie voor de text te veranderen in de drag and drop voor de bijlage
    var showFiles = function (files) {
        if (files.length > 1) {
            $('.file-label').text($('.upload-file').attr('data-multiple-caption').replace('{count}', files.length))
        } else {
            $('.file-label').text(files[0].name)
        }
    };

    // Feature detection voor drag events
    var hasDragNDropUpload = function () {
        var div = document.createElement('div')
        return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window
    }()

    // Als de feature kan gebruikt worden doe dit:
    if (hasDragNDropUpload) {
        $('.has-dragndrop').css('display', 'inline-block')

        //var droppedFiles = false;

        // Drag-event en feedback
        $('.upload-area').on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
                e.preventDefault();
                e.stopPropagation();
            })
            .on('drop', function (e) {
            droppedFiles = e.originalEvent.dataTransfer.files
            showFiles(droppedFiles)
            })
    } 

    $('.upload-file').on('change', function (e) {
        showFiles(e.target.files);
    })*/
    

    // Als het type persoon een bedrijf is toon dan extra invul opties
    $('#persoon').on('change', function () {
        var $type_persoon = $(this).find('option:selected').val();
        if ($type_persoon === 'bedrijf') {
            $('.gegevens-bedrijf').slideDown(300)
        } else {
            $('.gegevens-bedrijf').slideUp(300)
        }
    })

    // Als btw-plichting bent unlock BTW-nummer input
    $('#btw_plichtig').on('change', function () {
        var $btw_ok = $(this).find('option:selected').val();
        if ($btw_ok === "heeft een BTW-nummer") {
            $('#btw_input').removeAttr('disabled')
        } else {
            $('#btw_input').attr('disabled', 'disabled')
        }
    })

    // Als staffel is checked
    $('#staffel').on('change', function () {
        if ($(this).is(':checked')) {
            $('.oplage-staffel').slideDown(300)
        } else {
            $('.oplage-staffel').slideUp(300)
        }
    })
    
    // Als aantal versies groter is dan 1 geef extra opties voor input verdeling
    $('#aantal_versies_input').on('keyup change', function () {
        var $aantal = $(this).val();
        $aantal = parseInt($aantal)
        if ($aantal > 1) {
            $('.oplage-verdeling').css('display', 'flex')
        } else {
            $('.oplage-verdeling').css('display', 'none')
        }
    })

    // Toon verschillende extra opties afhangende van de optie van de omvang select bij Formaat en Omvang
    $('#omvang').on('change', function () {
        var $selected_omvang = $(this).find('option:selected').val();
        if ($selected_omvang === "enkel") {
            $('.omvang-aantal-luiken').css('display', 'none')
            $('.omvang-cover').css('display', 'none')
            $('.papier-soort').css('display', 'block')
            $('.papier-binnenwerk-cover').css('display', 'none')
        } else if ($selected_omvang === "gevouwen") {
            $('.omvang-aantal-luiken').css('display', 'block')
            $('.omvang-cover').css('display', 'none')
            $('.papier-soort').css('display', 'block')
            $('.papier-binnenwerk-cover').css('display', 'none')
        } else {
            $('.omvang-aantal-luiken').css('display', 'none')
            $('.omvang-cover').css('display', 'block')
            $('.papier-soort').css('display', 'none')
            $('.papier-binnenwerk-cover').css('display', 'flex')
        }
    })
    
    $('#selfcover').on('change', function () {
        if ($(this).find('option:selected').val() === "selfcover") {
            $('.omvang-cover-binnenwerk').slideUp(300)
            $('.papier-binnenwerk-cover-cover').css('display', 'none')
        } else {
            $('.omvang-cover-binnenwerk').slideDown(300)
            $('.papier-binnenwerk-cover-cover').css('display', 'block')
        }
    })

    // Styling toevoegen wanneer labels checked zijn bij Afwerking en Personalisatie
    $('label.check-label').on('click', function () {
        if ($(this).find('input[type="checkbox"]').is(':checked')) {
            $(this).addClass('active')
        } else {
            $(this).removeClass('active')
        }
    })

    // Aflevermethode radio button selected + slide down als value 'ander' adres is
    $('input[name="estimate[delivery][type]"]').on('change', function () {
        $('input[name="estimate[delivery][type]"]').parent('.zow-banner').css('opacity', '.4')
        $('.zow-banner').removeClass('active')
        if ($('input[name="estimate[delivery][type]"]').is(':checked')) {
            $(this).parent('.zow-banner').addClass('active')
            $(this).parent('.zow-banner').css('opacity', '1')
        }

        if ($(this).val() === "ander adres") {
            $('.ander-adres').slideDown(300)
        } else {
            $('.ander-adres').slideUp(300)
        }
    })

    // Navigatie toevoegen op de stappen, geef feedback en open de correcte section
    $stappen.on('click', function () {
        if ($('input:invalid').length > 0) {

            $('input:invalid').css('border', '2px solid red')
            $('.feedback-gegevens').html('Gelieve uw <strong>e-mailadres</strong> en uw <strong>telefoonnummer</strong> in te vullen.')
            $('.feedback-gegevens').css('color', 'red')
        } else {
            $('input[type="email"]').css('border', '2px solid #e5e5e5')
            $('input[type="tel"]').css('border', '2px solid #e5e5e5')
            $('.feedback-gegevens').html('Velden met een * zijn verplicht in te vullen.')
            $('.feedback-gegevens').css('color', '#4d4d4d')
            var $stap_nummer = $(this).index();
            $sections.css('display', 'none')
            $sections.eq($stap_nummer - 1).css('display', 'block')
            $('.current-stap').attr('data-position', $stap_nummer - 1)
            $stappen.each(function () {
                if ($(this).index() < $stap_nummer + 1) {
                    $(this).delay(600).addClass('finished')
                }
            })
        }
    })

    // Ga verder of terug functie en open juiste sections en duid de huidige stap aan
    // Validatie in eerste sections voor velden e-mail en telefoonnummer
    $buttons.on('click', function () {
        if ($('input:invalid').length > 0) {

            $('input:invalid').css('border', '2px solid red')
            $('.feedback-gegevens').html('Gelieve uw <strong>e-mailadres</strong> en uw <strong>telefoonnummer</strong> in te vullen.')
            $('.feedback-gegevens').css('color', 'red')
        } else {
            $('input[type="email"]').css('border', '2px solid #e5e5e5')
            $('input[type="tel"]').css('border', '2px solid #e5e5e5')
            $('.feedback-gegevens').html('Velden met een * zijn verplicht in te vullen.')
            $('.feedback-gegevens').css('color', '#4d4d4d')
            $stappen.removeClass('current-stap')
            var $this_section = $(this).parents("section:first"),
                $next_section = $this_section.next('section'),
                $prev_section = $this_section.prev('section');

            // VERDER
            if ($(this).val() === "verder") {
                $this_section.css('display', 'none')
                $next_section.css('display', 'block')
                $('.current-stap').attr('data-position', $next_section.index())
                $stappen.each(function () {
                    if ($(this).index() < $next_section.index() + 2) {
                        $(this).addClass('finished')
                    }
                })
                // TERUG
            } else if ($(this).val() === "terug") {
                $this_section.css('display', 'none')
                $prev_section.css('display', 'block')
                $('.current-stap').attr('data-position', $prev_section.index())
            }
        }
    })
})