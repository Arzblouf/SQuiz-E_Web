<?php ob_start(); ?>

<h1><?= htmlspecialchars($survey['title']) ?></h1>
<p>Theme: <?= htmlspecialchars($survey['theme']) ?></p>

<form method="POST" action="/survey/submit/<?= $survey['id'] ?>">
    <?php foreach ($questions as $index => $question): ?>
        <fieldset>
            <legend>
                Question <?= $question['num_question'] ?>: <?= htmlspecialchars($question['caption']) ?>
            </legend>

        <?php foreach ($question['answers'] as $answer): ?>
            <label>
                <input type="radio" name="question_<?= $question['id'] ?>" value="<?= $answer['id'] ?>" required>
                <?= htmlspecialchars($answer['content']) ?>
            </label><br>
        <?php endforeach; ?>
        </fieldset>
    <?php endforeach; ?>

    <button type="submit">Submit Answers</button>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>