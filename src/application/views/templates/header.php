<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= base_url() ?>dist/app.css">
    <script src="<?= base_url() ?>dist/app.js" defer></script>
    <title> <?= $title ?? '' ?></title>
</head>
<body class="skin-blue">
<!-- >sidebar-collapse">-->
<div class="wrapper">
    <!-- Main Header -->
    <?php include __DIR__."/../components/_header.php"?>
    <?php include __DIR__."/../components/_sidebar.php"?>

    <div class="content-wrapper">
        <div class="content-header">
            <section class="content-header">
                <h1>
                    <?= $title ?? 'Default title'?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"> <?= $title ?? 'Default title'?></li>
                </ol>
            </section>
            <section class="errors">
                <?php if(form_error()):?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo form_error('category_name'); ?>
                    </div>
                <?php endif ?>
            </section>
        </div>
        <div class="container-fluid">
            <div class="box" style="min-height: 100vh; margin-top:10px;">
                <!-- /.box-header -->
                <div class="box-body">
