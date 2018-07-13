(function ($) {
    $(document).ready(function () {//GROS PD
        let currentSkillCountSelector = $('#current_skill_count')
        let currentSkillCount = currentSkillCountSelector.val()
        let addButtonSelector = $('#add_skill_level')
        let contentDiv = $('#skill-level-content')
        let templateSelector = $('#skill-level-row')
        let templateContent = templateSelector.html()

        let addSkillLevel = (index) => {
            index++
            let template = getTemplate(index)
            currentSkillCountSelector.val(index)
            currentSkillCount = index
            contentDiv.append($('<div class="row"></div>').append(template))
        }

        let removeSkillLevel = (index) => {
            index--
            currentSkillCountSelector.val(index)
            currentSkillCount = index
        }

        let getTemplate = (index) => {
            let template = templateContent
            template = template.replace(/candidate_skills_name_[0-9]*/, 'candidate_skills_name_' + index)
            template = template.replace('candidate[skill][0][name]', 'candidate[skill][' + index + '][name]')
            console.log(template)

            return template
        }

        addButtonSelector.on('click', () => {
            addSkillLevel(currentSkillCount)
        })
    })
})(jQuery)
