async function loadSiteData() {
  try {
    const response = await fetch('site_data.json');
    const data = await response.json();

    document.title = `${data.brandName} | Full Stack Web Developer Portfolio`;
    document.querySelector('meta[name="description"]').setAttribute('content', data.heroDescription);
    document.querySelector('.brand .eyebrow').textContent = data.brandName;

    document.getElementById('hero-eyebrow').textContent = data.heroEyebrow;
    document.getElementById('hero-title').textContent = data.heroTitle;
    document.getElementById('hero-description').textContent = data.heroDescription;
    document.getElementById('hero-primary').textContent = data.heroPrimaryLabel;
    document.getElementById('hero-secondary').textContent = data.heroSecondaryLabel;

    document.getElementById('about-eyebrow').textContent = data.aboutEyebrow;
    document.getElementById('about-title').textContent = data.aboutTitle;
    document.getElementById('about-description').textContent = data.aboutDescription;

    const statsContainer = document.getElementById('about-stats');
    statsContainer.innerHTML = data.stats.map(stat => `
      <div>
        <strong>${stat.value}</strong>
        <span>${stat.label}</span>
      </div>
    `).join('');

    const aboutCards = document.getElementById('about-cards');
    aboutCards.innerHTML = data.aboutCards.map(card => `
      <article class="card">
        <h3>${card.title}</h3>
        <p>${card.description}</p>
      </article>
    `).join('');

    document.getElementById('services-title').textContent = data.servicesTitle;
    document.getElementById('service-grid').innerHTML = data.services.map(service => `
      <article class="service-card">
        <h3>${service.title}</h3>
        <p>${service.description}</p>
      </article>
    `).join('');

    document.getElementById('projects-title').textContent = data.projectsTitle;
    document.getElementById('project-grid').innerHTML = data.projects.map(project => `
      <article class="project-card">
        <h3>${project.title}</h3>
        <p>${project.description}</p>
      </article>
    `).join('');

    document.getElementById('testimonial-eyebrow').textContent = data.testimonialEyebrow;
    document.getElementById('testimonial-title').textContent = data.testimonialTitle;
    document.getElementById('testimonial-description').textContent = data.testimonialDescription;
    document.getElementById('testimonial-quote').textContent = data.testimonialQuote;
    document.getElementById('testimonial-author').textContent = data.testimonialAuthor;

    document.getElementById('contact-title').textContent = data.contactTitle;
    document.getElementById('contact-description').textContent = data.contactDescription;
    document.getElementById('contact-email').textContent = data.contactEmail;
    document.getElementById('contact-email').setAttribute('href', `mailto:${data.contactEmail}`);
    document.getElementById('contact-phone').textContent = data.contactPhone;
    document.getElementById('contact-phone').setAttribute('href', `tel:${data.contactPhone.replace(/[^+0-9]/g, '')}`);
    document.getElementById('contact-location').textContent = data.contactLocation;
    document.getElementById('feedback-title').textContent = data.feedbackTitle;
    document.getElementById('feedback-description').textContent = data.feedbackDescription;
    document.getElementById('footer-text').textContent = data.footerText;
  } catch (error) {
    console.error('Could not load site data:', error);
  }
}

loadSiteData();
