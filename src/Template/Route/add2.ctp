<?php
$this->start('script');
echo $this->Html->script('https://code.jquery.com/jquery-2.x-git.min.js');
echo $this->Html->script('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js');
echo $this->Html->css('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');

$this->end();

?>

<div class="route form large-9 medium-8 columns content">
    <?= $this->Form->create($route, ['id' => 'form1']) ?>
    <input type="hidden" name="from_type" id="from_type">
    <input type="hidden" name="to_type" id="to_type">
    <fieldset>
        <table>
            <td><?= $this->Form->control('from', [
                'required', 
                'placeholder' => 'Откуда',
                'label' => false, 
                'value' => '']); ?>
            <td><?= $this->Form->control('to', [
                'required', 
                'label' => false, 
                'placeholder' => 'Куда',
                'value' => '']); ?>
            <td><?= $this->Form->button(__('Сохранить'), ['id' => 'button1']) ?>
        </table>

    </fieldset>
    <?= $this->Form->end() ?>
</div>

<script>

/**
 * Применение jQuery UI autocmplete к элементу
 *
 * @param string el
 * @returns undefined
 */
function autocomplete(el) {
    $( el ).autocomplete( {
            source: '/route/search',
            minLength: 0,
            change( e, ui ) {
                /** Если пользователь ввел свои значение, то сброс */
                if ( ui.item == null ) {
                    $( e.target ).val('');
                    $( e.target ).focus();
                    console.error('Ошибка - введен не верный код!');
                }
            },
            focus( e, ui ) {
                /** Выбор елемента и загрузка массива данных в data  */
                $( e.target )
                    .val( ui.item.code )
                    .data( 'item',  ui.item );
                return false;
            },
            select( e, ui ) {
                 /** Выбор елемента и загрузка массива данных в data  */
                $( e.target )
                    .val( ui.item.code )
                    .data( 'item',  ui.item );
                return false;
            }
        } )
        .autocomplete( "instance" )._renderItem = function( ul, item ) {
            /** Генерация элемента списка выбора */
            return $( "<li>" )
                .append( "<div><strong>" + item.code + '</strong> ' + item.city_name + '/' + item.airport_name + " (Тип: <i>" + item.type + "</i>)"  + "</div>" )
                .appendTo( ul );
        };
}

    $( function() {
        /** Применение autocomplete к массиву из имен полей формы */
        [ 'to', 'from' ].forEach( function(el) {
            autocomplete('#' + el);
        } )

        $( '#form1' ).submit( function() {
            
            if (!$('#from').data('item') || !$('#to').data('item')) {
                console.error('Не все элементы корректно выбраны');
                alert('Не все элементы корректно выбраны');
                return false;
            }

            /** Установка в скрытые элементы типы city|airport */
            $( "#from_type" ).val( $('#from').data('item').type );            
            $( "#to_type" ).val( $('#to').data('item').type );
           
           $.ajax({
                context: this,
                type: 'POST',
                url: '/route/add',
                data: $('#form1').serializeArray(),
                dataType: 'json',
                error(res) {
                    /** Вывод в консоль ошибки сервера при обрадотке запроса */
                    console.error({res})
                },
                success(res) {

                    /** Ошибка добавления записи с сервера */
                    if (res.status === 'error') {
                        alert( res.message );
                        return console.error('Error', res);
                    }

                    /** Ответ от сервера - без ошибок */

                    var from = $('#from').data('item');
                    var to   = $('#to').data('item');
                    
                    /** Динамически добавление строки в таблицу без перезагрузки страницы  */
                    $('#table1 tbody').append(
                        $('<tr>').append(
                            $('<td>').text(from.code),
                            $('<td>').text(to.code),
                            $('<td>').text(from.city_name),
                            $('<td>').text(to.city_name),
                            $('<td>').text(from.airport_name),
                            $('<td>').text(to.airport_name),
                        )
                    );

                    /** Обнуление формы для ввода нового маршрута */
                    $('#from').val('');
                    $('#to').val('');
                }
            })  /**/
             return false;
        } )
    } )
</script>