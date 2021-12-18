var skill_count=1;
var education_count=1;
var experience_count=1;
function addSkill(){
    let addSkill = document.getElementById('addSkill');
    let skillHide = document.getElementById('skill_hide');
    if(skill_count<5)
    {
        ++skill_count;
        var field = 
        `<div>
            <label>Skillset Name</label>
            <input type="text" name="skill${skill_count}">
        </div>`;
        console.log(field);
        var htmlObject = document.createElement('div');
        htmlObject.innerHTML=field;
        addSkill.insertAdjacentElement("beforeend", htmlObject);
    }
    if(skill_count==5)
    {
        skillHide.style = "display:none";
    }
}

function addHobby(){
    let addHobby = document.getElementById('addHobby');
    let hobbyHide = document.getElementById('hobby_hide');
    if(hobby_count<4)
    {
        ++hobby_count;
        var field = 
        `<div>
            <label for="exampleInputEmail1">Hobby</label>
            <input type="text" name="hobby${hobby_count}">
        </div>`;
        var htmlObject = document.createElement('div');
        htmlObject.innerHTML=field;
        addHobby.insertAdjacentElement("beforeend", htmlObject);
    }
    if(hobby_count==4)
    {
        hobbyHide.style = "display:none";
    }
}
function addEducation(){
    let addEducation = document.getElementById('addEducation');
    let educationHide = document.getElementById('education_hide');
    if(education_count<3)
    {
        ++education_count;
        var field = 
        `<div class="mb-3">
            <label for="exampleInputEmail1">School/College/University</label>
            <input type="text" name="institute${education_count}">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1">Degree Name</label>
            <input type="text" name="degree${education_count}">
        </div>
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <label for="exampleInputEmail1">From</label>
                <input type="text" name="from${education_count}">
            </div>
            <div>
                <label for="exampleInputEmail1">To</label>
                <input type="text" name="to${education_count}">
            </div>
        </div>`;
        var htmlObject = document.createElement('div');
        htmlObject.innerHTML=field;
        addEducation.insertAdjacentElement("beforeend", htmlObject);
    }
    if(education_count==3)
    {
        educationHide.style = "display:none";
    }
}
function addExperience(){
    let addExperience = document.getElementById('addExperience');
    let experienceHide = document.getElementById('experience_hide');
    if(experience_count<3)
    {
        ++experience_count;
        var field = 
        `<div>
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="title${experience_count}">
        </div>
        <div>
            <label for="exampleInputEmail1">Description</label>
            <input type="text" name="description${experience_count}">
        </div>`;
        var htmlObject = document.createElement('div');
        htmlObject.innerHTML=field;
        addExperience.insertAdjacentElement("beforeend", htmlObject);
    }
    if(experience_count==3)
    {
        experienceHide.style = "display:none";
    }
}