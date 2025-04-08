<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat de Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pokemon-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .pokemon-img {
            width: 100%;
            max-height: 150px;
            object-fit: contain;
        }
        .round-card {
            background-color: #ffcccb;
            border-radius: 8px;
            padding: 10px;
            margin: 15px 0;
        }
        .round-title {
            color: #ff0000;
            font-weight: bold;
        }
        .attack-value {
            background-color: #e9ecef;
            padding: 5px 10px;
            border-radius: 4px;
        }
        .winner-card {
            background-color: #d1e7dd;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }
        .stats-line {
            border-bottom: 1px solid #eee;
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center">Combat de Pokémon</h1>
            </div>
        </div>