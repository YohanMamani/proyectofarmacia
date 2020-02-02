<?xml version="1.0" encoding="utf-8"?>
<!--Copyright, Microsoft Corporation, All rights reserved.-->
<Rule Name="ResolvedProjectReference" DisplayName="Разрешенная ссылка проекта" PageTemplate="generic" Description="Разрешенная ссылка" xmlns="http://schemas.microsoft.com/build/2009/properties">
    <Rule.DataSource>
        <DataSource Persistence="ResolvedReference" ItemType="ProjectReference" HasConfigurationCondition="False" SourceType="TargetResults" MSBuildTarget="ResolveProjectReferencesDesignTime"/>
    </Rule.DataSource>

    <StringListProperty Name="Aliases" DisplayName="Псевдонимы" Description="Разделенный запятыми список псевдонимов данной сборки." Separator=",">
        <StringListProperty.DataSource>
            <DataSource Persistence="ProjectFile" ItemType="ProjectReference" HasConfigurationCondition="False"/>
        </StringListProperty.DataSource>
    </StringListProperty>

    <BoolProperty Name="CopyLocal" DisplayName="Копировать локально" Description="Указывает, будет ли ссылочная сборка скопирована в выходной каталог.">
        <BoolProperty.DataSource>
            <DataSource Persistence="ProjectFile" ItemType="ProjectReference" HasConfigurationCondition="False" PersistedName="P