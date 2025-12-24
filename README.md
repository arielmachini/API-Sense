# API Sense

## About
API Sense is a tool that allows developers to assess the overall usability of their web APIs, since it is known to be a critical factor for their adoption. This tool—and the usability model it is built on top of—is meant for assessing certain aspects of a web API that can influence its usability. All metrics included in the model were extracted from reliable sources, such as academic research papers and blogs/guides written by web API experts.

### Usability
Usability is considered one of the most important software quality attributes (Nielsen, 1992) and, even though it has many definitions, the definition given by ISO 9241-11 is probably the most popular one: "The extent to which a product can be used by specified users to achieve specified goals with effectiveness, efficiency, and satisfaction in a specified context of use". This also applies to web APIs and, in a competitive market, usability can define the value and the success of an API.

### Usability model
As mentioned before, API Sense is built on top of a usability model, which we developed over several years and validated its different levels in different occasions. This model leverages the Goal-Question-Metric (GQM) approach (Basili et al., 1994) and consists of six goals, eight questions, and 45 usability metrics.

#### The GQM approach
The result of the application of the Goal-Question-Metric approach is the specification of a measurement system targeting a particular set of issues and a set of rules for the interpretation of the measurement data. The resulting model is comprised of three different, but related, levels:

- **Conceptual level (Goals):** Goals are defined for objects, which can be products (artifacts, deliverables, and documents that are produced during the system life cycle), processes (software related activities normally associated with time) and resources (items used by processes in order to produce their outputs).
- **Operational level (Questions):** Questions are used to characterize the way the achievement of a specific goal is going to be performed. Questions try to characterize the object of measurement with respect to a selected quality issue and to determine its quality from the selected viewpoint.
- **Quantitative level (Metrics):** A set of data is associated with every question in order to answer it in a quantitative way. The data can be objective (if they depend only on the object that is being measured) and subjective (if they depend on both the object that is being measured and the viewpoint from which they are taken).

In their paper, they describe a GQM model as a hierarchical structure starting with a goal (specifying purpose of measurement, object to be measured, issue to be measured, and viewpoint from which the measure is taken). The goal is refined into several questions, that usually break down the issue into its major components. Each question is then refined into metrics, some of them objective, some of them subjective.

# References
- Basili, V. R., Caldiera, G. & Rombach, H. D. (1994). *The Goal Question Metric approach*. Encyclopedia of software engineering, 528-532.
- Nielsen, J. (1992). *The usability engineering life cycle*. Computer, 25(3), 12–22. doi:10.1109/2.121503