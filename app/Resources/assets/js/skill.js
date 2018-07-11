(function ($) {
    $(document).ready(function () {

    console.log('skill.js');

    $('#selectskills').find('option').each(function(index, item){
      $(item).on("click", addSkill($(this).attr('id'), $(this).html()));
    });

    function addSkill(index, name){

      console.log('addSkill');
      var selectskills = $('#selectskills');
      optionskill = selectskills.find('#'+index);
      optionskill.attr('class', 'd-none');

      var newskill = $('#skilltable').find('tbody').find('#X');
      newskill = newskill.clone();
      newskill.attr('class', '');
      newskill.attr('id', index);
      newskill.attr('name', '');
      newskill.find('td').html(name);

    }

  });
})(jQuery)
