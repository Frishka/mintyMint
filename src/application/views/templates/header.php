<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url() ?>dist/app.css">
    <script src="<?= base_url() ?>dist/app.js"></script>
    <title> <?= $title ?? '' ?></title>
</head>
<body class="skin-blue">
<!-- >sidebar-collapse">-->
<div id="app">
<!-- Main Header -->
    <?php include __DIR__."/components/_header.php"?>
    <?php include __DIR__."/components/_sidebar.php"?>

<div class="content-wrapper">
    <div class="container-fluid">


        <div class="box" style="min-height: 100vh; margin-top:10px;">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $title ?? 'Page'?></h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">