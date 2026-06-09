const { createApp } = Vue;

const surveyAppElement = document.getElementById('survey-app');

if (surveyAppElement) {
    createApp({
        data() {
            return {
                answers: {},
                totalQuestions: Number(surveyAppElement.dataset.totalQuestions) || 0,
            };
        },
        computed: {
            answeredCount() {
                return Object.values(this.answers).filter(value => value !== null && value !== undefined && value !== '').length;
            },
            progress() {
                if (!this.totalQuestions) {
                    return 0;
                }
                return Math.round((this.answeredCount / this.totalQuestions) * 100);
            },
        },
    }).mount(surveyAppElement);
}
