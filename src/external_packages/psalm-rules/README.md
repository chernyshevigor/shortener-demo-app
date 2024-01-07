# @todo: use-me as a separate repo

### psalm-rules

## Usage

### Ability to include external files

There is need to add following attribute inside the tag `<psalm>`:

`xmlns:xi="http://www.w3.org/2001/XInclude"`

The result will be looked like this:

```xml
<?xml version="1.0"?>
<psalm
    errorLevel="3"
    resolveFromConfigFile="true"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:xi="http://www.w3.org/2001/XInclude"
    xmlns="https://getpsalm.org/schema/config"
    xsi:schemaLocation="https://getpsalm.org/schema/config vendor/vimeo/psalm/config.xsd"
>
</psalm>
```

### Import full blocks of configuration

If you'd like to use blocks of configuration fully (ex. block `projectFiles`)
you'll have to use following syntax:

```xml
<xi:include href="src/external_packages/psalm-rules/config/default_project_files.xml"/>
```

### Import blocks of configuration into existing blocks:

If you have some block of configuration (ex. `projectFiles`)
and you'd like to load inside it the configuration of this package
then syntax will be with xpointer:

```xml
<projectFiles>
    <directory name="tests"/>
    <xi:include href="src/external_packages/psalm-rules/config/default_issue_handlers.xml" xpointer="xmlns(ps=https://getpsalm.org/schema/config)xpointer(/ps:projectFiles/*)"/>
</projectFiles>
```
