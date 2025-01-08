function displayProjects() {
    const projectContainer = document.getElementById('projects');
    const projects = JSON.parse(localStorage.getItem('projects')) || [];
    // const projects = [
    //     {
    //         "imageUrl": "images/porto2.png",
    //         "tags": "HTML,CSS",
    //         "name": "Majapahit Riders",
    //         "desc": "A motorcycle club website is a digital hub for members, offering event schedules, membership details, and communication tools to connect riders and share club-related information."
    //     }
    // ]

    // Kosongkan container sebelum render
    projectContainer.innerHTML = '';

    // Render project card
    projects.forEach((project, index) => {
        const card = document.createElement('div');
        card.classList.add('col-md-4', 'd-flex');
        card.innerHTML = `
					<div class="blog-entry justify-content-end">
						<a href="#" class="block-20" style="background-image: url('${project.imageUrl}');"></a>
						<div class="text mt-3 float-right d-block">
							<div class="d-flex align-items-center mb-3 meta">
								<p class="mb-0">
									<span class="mr-2">${project.tags}</span>
								</p>
							</div>
							<h3 class="heading"><a href="#.html">${project.title}</a></h3>
							<p style="width: 350px;">${project.description}</p>
						</div>
                        <div>
                        <a href="detail_project.html?index=${index}">View Details</a>
                    </div>
					</div>
        `;
        projectContainer.appendChild(card);
    });
}

document.addEventListener('DOMContentLoaded', displayProjects);

{/* <div class="col-md-4 d-flex ftco-animate">
    <div class="blog-entry justify-content-end">
        <a href="single.html" class="block-20" style="background-image: url('images/porto2.png');"></a>
        <div class="text mt-3 float-right d-block">
            <div class="d-flex align-items-center mb-3 meta">
                <p class="mb-0">
                    <span class="mr-2">HTML,CSS</span>
                </p>
            </div>
            <h3 class="heading"><a href="single.html">Majapahit Riders</a></h3>
            <p>A motorcycle club website is a digital hub for members, offering event schedules, membership details, and communication tools to connect riders and share club-related information.</p>
        </div>
    </div>
</div> */}