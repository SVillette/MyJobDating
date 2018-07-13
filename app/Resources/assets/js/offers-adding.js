let mySkillAdder = function() {
    let myRowCounter = 1;

    let mySkillRow = $(".skill-row")

    $(".add-skill-btn").click(function() {
        $(".skills").append(mySkillRow.clone().attr("id", ++myRowCounter))
    })

    $(".remove-skill-btn").click(function() {
        let myLastRow = $(".skill-row:last-child")

        if ( !myLastRow.is(":first-child") ) {
            myLastRow.remove()
            myRowCounter--
        }
    })
}

$(document).ready(function() {
    mySkillAdder()
})