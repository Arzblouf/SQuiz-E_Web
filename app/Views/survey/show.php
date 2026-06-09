<?php
ob_start();

if (!isset($survey) || !is_array($survey)) {
    $survey = ['title' => '', 'name' => '', 'id' => ''];
}
if (!isset($questions) || !is_array($questions)) {
    $questions = [];
}
?>

<div id="survey-app" data-total-questions="<?= count($questions) ?>">
    <h1><?= htmlspecialchars($survey['title']) ?></h1>
    <p>Theme: <?= htmlspecialchars($survey['name']) ?></p>
    <br>
    <br>

    <div class="progress-bar">
        <div class="progress-fill" :style="{ width: progress + '%' }"></div>
        <span class="progress-text">Progress: {{ progress }}%</span>
    </div>
    <p class="progress-summary">Répondu {{ answeredCount }} sur <?= count($questions) ?> questions</p>

    <form method="POST" action="/survey/submit/<?= $survey['id'] ?>">
        <?php foreach ($questions as $index => $question): ?>
            <fieldset>
                <legend>
                    Question <?= $index + 1 ?>: <?= htmlspecialchars($question['caption']) ?>
                </legend>
                <?php foreach ($question['answers'] as $answer): ?>
                    <label>
                        <input
                            type="radio"
                            name="question_<?= $question['id'] ?>"
                            value="<?= $answer['id'] ?>"
                            v-model="answers['question_<?= $question['id'] ?>']"
                            required
                        >
                        <?= htmlspecialchars($answer['content']) ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>

        <button type="submit">Envoyer vos réponses.</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>